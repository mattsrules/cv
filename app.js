document.addEventListener("DOMContentLoaded", event => {

    const app = firebase.app();
    const db = firebase.firestore();
    
    const myPost = db.collection('posts').doc('firstpost');
    
    myPost.get()
        .then(doc => {
    
                const data = doc.data();
                document.write( data.title + '<br>')
                document.write(data.createdAt )
        })
    })