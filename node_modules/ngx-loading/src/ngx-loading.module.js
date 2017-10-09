import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { LoadingComponent } from './ngx-loading.component';
import { LoadingConfigService } from './ngx-loading.service';
var LoadingModule = (function () {
    function LoadingModule() {
    }
    LoadingModule.forRoot = function (loadingConfig) {
        return {
            ngModule: LoadingModule,
            providers: [{ provide: 'loadingConfig', useValue: loadingConfig }]
        };
    };
    LoadingModule.decorators = [
        { type: NgModule, args: [{
                    imports: [CommonModule],
                    exports: [LoadingComponent],
                    declarations: [LoadingComponent],
                    providers: [LoadingConfigService],
                },] },
    ];
    /** @nocollapse */
    LoadingModule.ctorParameters = function () { return []; };
    return LoadingModule;
}());
export { LoadingModule };
//# sourceMappingURL=ngx-loading.module.js.map