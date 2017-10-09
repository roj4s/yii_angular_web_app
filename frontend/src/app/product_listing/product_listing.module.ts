import {NgModule} from "@angular/core";
import {ProductListingMainComponent} from "./main/main.component";
import {FlexLayoutModule} from "@angular/flex-layout";
import {MatButtonModule, MatCardModule} from '@angular/material';
import {CommonModule} from "@angular/common";
import { SweetAlertService } from 'ng2-sweetalert2';

@NgModule(
    {
        imports:[
            FlexLayoutModule,
            MatCardModule,
            CommonModule,
            MatButtonModule
        ],
        declarations: [
            ProductListingMainComponent
        ],
    }
)

export class ProductListingModule { }