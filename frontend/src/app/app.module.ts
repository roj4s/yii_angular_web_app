import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppComponent } from './app.component';
import {ConfigService} from "./config.service";
import {HeaderComponent} from "./layouts/components/header/header.component";
import {SidebarComponent} from "./layouts/components/sidebar/sidebar.component";
import {AppRoutingModule} from "./app.routing";
import {PageNotFoundComponent} from "./extra/pagenotfound_component/pagenotfound.component";
import {ApiService} from "./api_service/api.service";
import {HttpModule} from "@angular/http";
import {LoadingModule} from "ngx-loading";
import {DashboardModule} from "./dashboard/dashboard.module";
import {ProductListingModule} from "./product_listing/product_listing.module";
import {CreateNewProductModule} from "./create_new_product/new_product.module";

@NgModule({
  declarations: [
    AppComponent,
    HeaderComponent,
    SidebarComponent,
    PageNotFoundComponent,

  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
      HttpModule,
      LoadingModule,
      DashboardModule,
      ProductListingModule,
      CreateNewProductModule
  ],
  providers: [
      ConfigService,
      ApiService
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
