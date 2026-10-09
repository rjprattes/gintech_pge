import { Component, inject } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-painel',
  standalone: true,
  imports: [],
  templateUrl: './painel.component.html'
})
export class PainelComponent {
  private router = inject(Router);
  funcionario: any = null;

  ngOnInit() {
    // Quando o componente inicia, vai buscar os dados ao Local Storage
    const dados = localStorage.getItem('funcionario');
    if (dados) {
      this.funcionario = JSON.parse(dados);
    }
  }

  sair() {
    // Remove o token de segurança do armazenamento do navegador
    localStorage.removeItem('token');
    localStorage.removeItem('funcionario');

    // Expulsa o utilizador de volta para o ecrã de autenticação
    this.router.navigate(['/login']);
  }
}