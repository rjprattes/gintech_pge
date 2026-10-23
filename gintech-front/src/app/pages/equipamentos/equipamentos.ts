import { Component, OnInit, inject } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms'; // Obrigatório para o formulário
import { EquipamentoService } from '../../services/equipamento.service';

@Component({
  selector: 'app-equipamentos',
  standalone: true,
  imports: [CommonModule, FormsModule],
  templateUrl: './equipamentos.html'
})
export class EquipamentosComponent implements OnInit {
  private equipamentoService = inject(EquipamentoService);
  
  equipamentos: any[] = [];
  totalAtivos = 0;
  totalManutencao = 0;
  
  mostrarModal = false;
  equipamentoAtual: any = {}; // Guarda os dados do formulário

  ngOnInit() { this.carregarDados(); }

  carregarDados() {
    this.equipamentoService.listar().subscribe({
      next: (dados) => {
        this.equipamentos = dados;
        this.totalAtivos = dados.filter(e => e.status === 'Ativo').length;
        this.totalManutencao = dados.filter(e => e.status === 'Em Manutenção').length;
      }
    });
  }

  abrirModal(item?: any) {
    this.equipamentoAtual = item ? { ...item } : { status: 'Ativo' };
    this.mostrarModal = true;
  }

  fecharModal() {
    this.mostrarModal = false;
    this.equipamentoAtual = {};
  }

  salvar() {
    this.equipamentoAtual.organizacao_id = 1;
    const acao = this.equipamentoAtual.id 
      ? this.equipamentoService.atualizar(this.equipamentoAtual.id, this.equipamentoAtual)
      : this.equipamentoService.criar(this.equipamentoAtual);

    acao.subscribe({
      next: () => {
        this.carregarDados();
        this.fecharModal();
      },
      error: (err) => alert('Erro ao salvar: ' + (err.error?.message || 'Verifique os dados'))
    });
  }

  excluir(id: number) {
    if (confirm('Tem a certeza que deseja excluir este equipamento?')) {
      this.equipamentoService.excluir(id).subscribe({
        next: () => this.carregarDados(),
        error: () => alert('Erro ao excluir.')
      });
    }
  }
}