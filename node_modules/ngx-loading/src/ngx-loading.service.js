import { Injectable, Inject, Optional } from '@angular/core';
import { LoadingConfig } from './ngx-loading.config';
var LoadingConfigService = (function () {
    function LoadingConfigService(config) {
        this.config = config;
        this.loadingConfig = config || new LoadingConfig();
    }
    LoadingConfigService.decorators = [
        { type: Injectable },
    ];
    /** @nocollapse */
    LoadingConfigService.ctorParameters = function () { return [
        { type: undefined, decorators: [{ type: Optional }, { type: Inject, args: ['loadingConfig',] },] },
    ]; };
    return LoadingConfigService;
}());
export { LoadingConfigService };
//# sourceMappingURL=ngx-loading.service.js.map