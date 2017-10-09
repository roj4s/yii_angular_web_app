import {NgModule} from '@angular/core';
import {Routes, RouterModule} from '@angular/router';
import {PageNotFoundComponent} from "./extra/pagenotfound_component/pagenotfound.component";
import {AppComponent} from "./app.component";
import {ProductListingMainComponent} from "./product_listing/main/main.component";
import {DashboardComponent} from "./dashboard/dashboard.component";
import {CreateNewProductComponent} from "./create_new_product/new_product.component";

export const routes: Routes = [

    {
        path: '',
        redirectTo: '/products/-1',
        pathMatch: 'full'
    },/*
    {
        path: '',
        component:AppComponent,
    },*/
    {
        path:'dashboard',
        component: DashboardComponent
    },
    {
        path:'products/:id_department',
        component: ProductListingMainComponent
    },
    {
        path:'new_product',
        component: CreateNewProductComponent
    },

    { path: '**', component: PageNotFoundComponent }
];

@NgModule({
    imports: [RouterModule.forRoot(routes)],
    exports: [RouterModule]
})
export class AppRoutingModule {
}
