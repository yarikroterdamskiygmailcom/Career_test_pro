export default{
    find_language_now_in_array(array,lang){
        let data;
        array.forEach(item => {
            typeof lang == 'string' && (item.code == lang.toLowerCase() || item.code == lang.toUpperCase()) ? data = item : null
        });
        return data;
    }
}
