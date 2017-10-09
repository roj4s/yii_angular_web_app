
import {NgModule} from "@angular/core";
import {MatInputModule} from '@angular/material';
import {CreateNewProductComponent} from "./new_product.component";
import {BrowserAnimationsModule} from "@angular/platform-browser/animations";
import {FormsModule} from "@angular/forms";

@NgModule(
    {
        imports:[
            MatInputModule,
            BrowserAnimationsModule,
            FormsModule
        ],
        providers:[

        ],
        declarations: [
            CreateNewProductComponent
        ],
    }
)

export class CreateNewProductModule { }