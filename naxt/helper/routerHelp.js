const actionRouter = {
    "home":          {brockenPath:'/home/',           path:'/home'},
    "blog":          {brockenPath:'/blog/',           path:'/blog'},
    "confirm-detail":{brockenPath:'/confirm-detail/', path:'/confirm-detail'},
    "contact-us":    {brockenPath:'/contact-us/',     path:'/contact-us'},
    "about-us":      {brockenPath:'/about-us/',       path:'/about-us'},
    "faq":           {brockenPath:'/faq/',            path:'/faq'},
    "final":         {brockenPath:'/final/',          path:'/final'},
};

export const RETURN_ROUTER = {
    initRouter(history){
        switch (history.path) {
            case this.getURl('home','brockenPath'):
                return this.replaceRouter(this.getURl('home','path'), history.query);
            case this.getURl('confirm-detail', 'brockenPath'):
                return this.replaceRouter(this.getURl('confirm-detail','path'), history.query);
            case this.getURl('contact-us', 'brockenPath'):
                return this.replaceRouter(this.getURl('contact-us','path'), history.query);
            case this.getURl('faq', 'brockenPath'):
                return this.replaceRouter(this.getURl('faq','path'), history.query);
            case this.getURl('final', 'brockenPath'):
                return this.replaceRouter(this.getURl('final','path'), history.query);
            case this.getURl('blog','brockenPath'):
                return this.replaceRouter(this.getURl('blog','path'), history.query);
            case this.getURl('about-us', 'brockenPath'):
                return this.replaceRouter(this.getURl('about-us','path'), history.query);
        }
        return false;
    },
    replaceRouter: (path, query) => `${path}?lang=${query && query.lang ?query.lang : ''}`,
    getURl:(url, type) => actionRouter[url][type],
    redirectCustom(history){
        try {
            const resRout = this.initRouter(history);
            if(resRout) window.location.href = `/?rout=${base64encode(resRout)}`;
        } catch (e) {}
    }
}
