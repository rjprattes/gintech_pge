import { inject } from '@angular/core';
import { Router, CanActivateFn } from '@angular/router';

export const authGuard: CanActivateFn = (route, state) => {
  const router = inject(Router);
  const token = localStorage.getItem('token');

  // Se o token existir, permite a entrada na rota
  if (token) {
    return true;
  }

  // Se não existir, expulsa de volta para o login
  router.navigate(['/login']);
  return false;
};