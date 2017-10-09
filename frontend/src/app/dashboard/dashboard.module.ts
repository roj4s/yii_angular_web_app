import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';


import {ProductsCarrouselComponent} from "./products_carrousel/products_carrousel.component";
import {DashboardComponent} from "./dashboard.component";
import {LoadingModule} from "ngx-loading";
import {ApiService} from "../api_service/api.service";
import { CarouselModule } from 'angular4-carousel';

@NgModule({
    imports: [
        CommonModule,
        LoadingModule,
        CarouselModule
    ],
    providers:[
        ApiService
    ],
    declarations: [
        DashboardComponent,
        ProductsCarrouselComponent
    ]
})
export class DashboardModule { }
