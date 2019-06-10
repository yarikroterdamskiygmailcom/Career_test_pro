import axios from "./api/axios.config";
export default {
    async nuxtServerInit({commit}, {redirect}) {
        let arr = ['91.228.236.253'];
        return await axios.get('http://gd.geobytes.com/GetCityDetails')
            .then(response => {
                if(arr.indexOf(response.data.geobytesremoteip) == -1) {
                    commit('multilanguage/change_state', {
                        data: true,
                        name: 'active'
                    });
                    redirect('/mode')
                }
            })
            .catch(e => {
                console.log(e)
            })
    }
}
