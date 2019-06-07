export default{
    find_language_now_in_array(array,lang){
        let data;
        Array.isArray(lang) ? lang = lang[0] : lang = lang ? lang :'';
        array.forEach(item => {
            item.code.indexOf(lang.toLowerCase()) > -1 || item.code.indexOf(lang.toUpperCase()) > -1 ? data = item : null
        });
        return data ? data : array[0];
    }
}
