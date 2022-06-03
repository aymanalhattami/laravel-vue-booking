export const is404 = function(err){
    return isErrorWithReponseAndStatus(err) && 404 === err.response.status    
}

export const is422 = function(err){
    return isErrorWithReponseAndStatus(err) && 422 === err.response.status;
}

const isErrorWithReponseAndStatus = function(err){
    return err.response && err.response.status;
}