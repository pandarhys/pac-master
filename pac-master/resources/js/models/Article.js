class Article {

    static find(id){

        return axios.get('/article/' + id)
    }

    static all(then) {

        return axios.get('/article')

            .then(({data}) => then(data));

    }
}

export default Article;
