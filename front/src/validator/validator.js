

export default  {
    set(value, params = [], field, text){
        const data = {};
        params.forEach(item => {
            let res = this.methods[item](value, field, text);
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
            return this.messages(!value, 'required')
        },
        email(value){
            var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return this.messages(re.test(value) ? false : true, 'email invalid');
        },
        // radio(value = [], field, text){
        //     let count = true;
        //     value.forEach(item => {
        //         if(item[field] == text) {
        //             return count = false;
        //         }
        //     });
        //     return this.message(count);
        // },
        messages(status, message){
            return status == false ? false : message
        }
    }
}
