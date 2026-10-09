import { Routes } from '@angular/router';
import { LoginComponent } from './pages/login/login.component';
import { PainelComponent } from './pages/painel/painel.component';
import { LayoutComponent } from './components/layout/layout.component';
import { authGuard } from './guards/auth.guard';

export const routes: Routes = [
  { path: 'login', component: LoginComponent },
  
  // O Layout protege todas as rotas filhas com o authGuard
  { 
    path: '', 
    component: LayoutComponent, 
    canActivate: [authGuard],
    children: [
      { path: 'painel', component: PainelComponent },
      // Futuramente, adicionar aqui: { path: 'equipamentos', component: EquipamentosComponent }
      { path: '', redirectTo: 'painel', pathMatch: 'full' }
    ]
  },
  
  { path: '**', redirectTo: '/login' }
];