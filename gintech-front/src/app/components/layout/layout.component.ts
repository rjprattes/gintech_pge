import { Component, inject } from '@angular/core';
import { Router, RouterModule } from '@angular/router'; 

@Component({
  selector: 'app-layout',
  standalone: true,
  imports: [RouterModule], // Tem de estar aqui!
  templateUrl: './layout.component.html'
})
export class LayoutComponent {
  private router = inject(Router);

  sair() {
    localStorage.removeItem('token');
    localStorage.removeItem('funcionario');
    this.router.navigate(['/login']);
  }
}