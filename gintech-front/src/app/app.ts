import { Component } from '@angular/core';
import { RouterOutlet } from '@angular/router';

@Component({
  selector: 'app-root',
  standalone: true,
  imports: [RouterOutlet], // Apenas o RouterOutlet fica aqui!
  templateUrl: './app.component.html'
})
export class App {
  title = 'gintech-front';
}