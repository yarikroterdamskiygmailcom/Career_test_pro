
export const state = () => ({
    active: false,
    language_now: {
        id: 1,
        language: "English",
        code: "en"
    },
    lang: 'eee',
    tests: 0,
    menu_list: [
        {
            name: 'Home',
            path: '/home'
        },{
            name: 'FAQ',
            path: '/faq'
        },{
            name:  'Blog',
            path: '/blog'
        },{
            name:  'Contact Us',
            path: '/contact-us'
        },{
            name:  'About Us',
            path: '/about-us'
        },
    ],
    language_array:[
        {
            name:'RU',
            full_name:'Russian',
            path: '/ru'
        },
        {
            name: 'EN',
            full_name: 'English',
            path: '/ru'
        }
    ],
    sotial_networks: [
        {
            name: 'linkedin',
            path: 'http://admin.careertestpro.com/assets/linkedin.png'
        },{
            name: 'twitter',
            path: 'hhttp://admin.careertestpro.com/assets/twitter.png'
        },{
            name: 'facebook',
            path: 'http://admin.careertestpro.com/assets/facebook.png'
        },
    ],
    price:{},
    data:{},
    test: false
});
