define( [],
function(){
    return {
        moduleManager: {
            'maggott/ServerLogRenderer': {
                proxyMethods: [
                    'render'
                ]
            },
            'havok/store/storeManager': {
                proxies: {
                    stores: [
                        {
                            base: 'havok/store/JsonRest',
                            proxyMethods: ['get', 'put', 'add', 'remove', 'query'],
                            params: {
                                name: 'exception',
                                target: 'http://localhost/ZendSkeletonApplication/exception'
                            }
                        }
                    ]
                }
            }
        }
    }
});
