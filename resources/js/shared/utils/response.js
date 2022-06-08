export const is404 =  function(err){
    return isErrorWithResponseStatus(err) && err.response.status == 404
};

export const is422 = function (err) {
    return isErrorWithResponseStatus(err) && err.response.status == 422
};

const isErrorWithResponseStatus = function(err){
    return err.response && err.response.status;
}
