import { Component } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  routerList: any[];

  constructor(private router: Router) {
    this.bindRouteList();
  }

  bindRouteList() {
    this.routerList = this.router.config.filter((route) => {
      return route.path != '**' && route.path != '';
    });
  }
}
