
export const request = (request, next) => {
    // const loading = Loading.service(LOADING_CONFIG);

    next(() => {console.log(11)
        // loading.close();
    });
};

export const response = (request, next) => {
    next(response => {
        console.log(22)
        // if (response.status > 308) {
        //     alert('API Error');
        // }
    })
};
