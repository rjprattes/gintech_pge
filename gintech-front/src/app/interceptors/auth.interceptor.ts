import { HttpInterceptorFn } from '@angular/common/http';

export const authInterceptor: HttpInterceptorFn = (req, next) => {
  const token = localStorage.getItem('token');

  // Se tivermos um token guardado, clonamos o pedido original e injetamos o cabeçalho Authorization
  if (token) {
    const clonedRequest = req.clone({
      setHeaders: {
        Authorization: `Bearer ${token}`
      }
    });
    return next(clonedRequest);
  }

  // Se não houver token (ex: na hora do login), o pedido segue normal
  return next(req);
};