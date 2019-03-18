

export default  {
    set(value, params = [], text){
        const data = {};
        params.forEach(item => {
            let res = this.methods[item](value, text);
            if(res != false) data[item] = res;
        });
        return Object.keys(data).length == 0
            ? {
                errors: false
            } : {
                message:data,
                errors: true
            };
    },
    methods:{
        required(value){
            return this.messages(!value, 'This field is required')
        },
        email(value){
            var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return this.messages(re.test(value) ? false : true, 'Email invalid');
        },
        radio(value = [],field){
            let count = true;
            value.forEach(item => {
                if(item[field]) {
                    return count = false;
                }
            });
            return this.messages(count, 'You have to choose radiobutton');
        },
        messages(status, message){
            return status == false ? false : message
        },
        dropdown(value, standart_text){
            return this.messages(
                value !=  standart_text? false : true,
                'You have to choose element in dropdown'
            );
        }
    }
}
