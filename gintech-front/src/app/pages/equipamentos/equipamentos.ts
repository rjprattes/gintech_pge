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
  totalGeral = 0;

  mostrarModal = false;
  equipamentoAtual: any = {};
  paginaAtual = 1;
  itensPorPagina = 15;
  totalPaginas = 1;
  opcoesPorPagina = [15, 20, 50, 100];

  ngOnInit() { this.carregarDados(); }

  carregarDados() {
    this.equipamentoService.listar(this.paginaAtual, this.itensPorPagina).subscribe({
      next: (resposta) => {
        this.equipamentos = resposta.paginacao.data;
        this.paginaAtual = resposta.paginacao.current_page;
        this.totalPaginas = resposta.paginacao.last_page;
        
        // Atualiza os totais reais vindos do banco de dados
        this.totalGeral = resposta.resumo.total;
        this.totalAtivos = resposta.resumo.ativos;
        this.totalManutencao = resposta.resumo.manutencao;
      }
    });
  }

  // Novo método para controlar os botões de Avançar/Recuar
  mudarPagina(novaPagina: number) {
    if (novaPagina >= 1 && novaPagina <= this.totalPaginas) {
      this.paginaAtual = novaPagina;
      this.carregarDados();
    }
  }

  // Novo método para quando o usuário alterar o Dropdown (15, 20, 50...)
  mudarLimite() {
    this.paginaAtual = 1; // Volta para a primeira página sempre que mudar o limite
    this.carregarDados();
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