define([
    'dojo/_base/declare',
    'dojo/_base/lang',
    'havok/get!havok/store/storeManager'
],
function(
    declare,
    lang,
    storeManager
){
    return declare(
        [],
        {
            render: function(exceptionModel){

                lang.mixin(exceptionModel, {
                    pageUrl: window.location.href,
                    pageTitle: document.title,
                    referrerUrl: document.referrer,
                    operatingSystem: navigator.platform,
                    browserName: navigator.appName,
                    browserVersion: navigator.appVersion
                });

                var store = storeManager.getStore('exception');
                store.put(exceptionModel);
            }
        }
    );
});
