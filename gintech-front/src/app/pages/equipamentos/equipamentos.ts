import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-equipamentos',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './equipamentos.html'
})
export class EquipamentosComponent {
  // Dados temporários para testarmos o design
  equipamentos = [
    { id: 1, nome: 'Computador Desktop Dell', patrimonio: '100234', status: 'Ativo' },
    { id: 2, nome: 'Monitor Lenovo 24"', patrimonio: '100235', status: 'Em Manutenção' },
    { id: 3, nome: 'Impressora Multifuncional', patrimonio: '100236', status: 'Inativo' },
    { id: 4, nome: 'Notebook HP', patrimonio: '100237', status: 'Ativo' },
    { id: 5, nome: 'Roteador Cisco', patrimonio: '100238', status: 'Ativo' },
    { id: 6, nome: 'Switch Netgear', patrimonio: '100239', status: 'Ativo' },
    { id: 7, nome: 'Servidor Dell PowerEdge', patrimonio: '100240', status: 'Em Manutenção' },
    { id: 8, nome: 'Estabilizador APC', patrimonio: '100241', status: 'Ativo' },
    { id: 9, nome: 'Projetor Epson', patrimonio: '100242', status: 'Inativo' },
    { id: 10, nome: 'Scanner Fujitsu', patrimonio: '100243', status: 'Ativo' },
    { id: 11, nome: 'Telefone IP Cisco', patrimonio: '100244', status: 'Ativo' },
    { id: 12, nome: 'Câmera de Segurança Hikvision', patrimonio: '100245', status: 'Ativo' },
    { id: 13, nome: 'No-break SMS', patrimonio: '100246', status: 'Em Manutenção' },
    { id: 14, nome: 'Tablet Samsung Galaxy', patrimonio: '100247', status: 'Ativo' },
    { id: 15, nome: 'Roteador TP-Link', patrimonio: '100248', status: 'Inativo' }
  ];
}