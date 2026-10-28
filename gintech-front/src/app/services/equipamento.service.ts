import { Injectable, inject } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({ providedIn: 'root' })
export class EquipamentoService {
  private http = inject(HttpClient);
  private apiUrl = 'http://10.182.104.21:8000/api';

  listar(pagina: number = 1, limite: number = 15) { 
    return this.http.get<any>(`${this.apiUrl}/equipamentos?page=${pagina}&per_page=${limite}`); 
  }
  criar(dados: any) { return this.http.post(`${this.apiUrl}/equipamentos`, dados); }
  atualizar(id: number, dados: any) { return this.http.put(`${this.apiUrl}/equipamentos/${id}`, dados); }
  excluir(id: number) { return this.http.delete(`${this.apiUrl}/equipamentos/${id}`); }
}