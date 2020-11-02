<template>
    <div class="full-margin">
        <prompt-valide v-if="postSend"></prompt-valide>
        <form @submit.prevent="send">
            <br>
            <transition name="appear" mode="out-in" appear>
                <div v-if="error" class="alert alert-info">{{ error }}</div>
            </transition>
            <div class="champ px-3 d-flex flex-column align-items-end">
                <input required v-model="author" placeholder="Créateur" type="text" class="align-self-start px-2 bg-pink-flash">
                <textarea required v-model="description" placeholder="Description" class="px-2 bg-pink-flash mt-4" rows="5"></textarea>
                
                <input v-for="(n, index) in count" v-model="pictures[index]" required placeholder="Image (url direct)" type="text" class="px-2 bg-pink-flash mt-4" :key="'input' + index">
                
                <img v-if="count < 3" @click="otherPicture" class="mt-4 mr-2" src="/img/svg/new.svg" alt="Ajouter une photo supplémentaire">
            </div>
            
            <div class="bloc-post bg-pink-flash mt-5">
                <button v-if="!loadSend" type="submit" class="d-flex justify-content-center align-items-center forme bg-black">
                    <h2>POSTER</h2>
                </button>
                <div v-else class="d-flex justify-content-center align-items-center forme bg-black">
                    <div class="spinner-border text-danger" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <div class="my-4 mx-3">
                    <p>
                        Poster jusqu'à 3 images, grace a cela vous n'aurez plus de doute sur votre choix !
                    </p><br>
                    <p>
                        Poster des styles, couleurs, nom, typo … absolument tout a partir du moment ou vous hésiter.
                    </p>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import PromptValide from '../shares/PromptValide';

export default {
    components : {
        PromptValide
    },
    data() {
        return {
            error: false,
            count: 1,
            description: null,
            author: null,
            pictures: [],
            postSend: false,
            loadSend: false,
        }
    },
    methods: {
        send() {
            this.loadSend = true;
            axios.post('/api/post/new',
            {   
                author: this.author,
                description: this.description,
                pictures: this.pictures,
            }
            ).then((response) => {
                this.loadSend = false;
                if(response.data.error){
                    this.error = response.data.message;
                }else {
                    this.error = false;
                    this.pictures = [];
                    this.postSend = true;
                }
            })
        },
        otherPicture() {
            if(this.count < 3){
                this.count +=1;
            }
        }
    }
}
</script>

<style scoped>
h2 {
    font-size: 2.3rem;
}

p {
    font-size: 0.95rem;
}

button {
    border: inherit;
    color: white;
}

textarea {
    color: white;
    border: none;
    width: 80vw;
    border-radius: 15px;
}

input {
    color: white;
    border: none;
    width: 65vw;
    border-radius: 10px;
    height: 3rem;
}

input::placeholder, textarea::placeholder {
    color: white;
    font-size: 1.5rem;
}

input:focus, textarea:focus
{   
    color: white;
    outline: none;
    box-shadow: 9px 8px 15px 0px #000000b7;
    transform: scale(1.05);
    transition: all 200ms linear;
}

img {
    width: 3.8rem;
}

.champ {
    margin-bottom: 40vh;
    padding-bottom: 20px;
}

.forme {
    position: relative;
    width: 110%;
    left: -5%;
    box-shadow: 9px 8px 15px 0px #000000b7;
    height: 6rem;
    border-bottom-left-radius: 200px 120%;
    border-bottom-right-radius: 200px 120%;
}

.bloc-post {
    height: 40vh;
    position: fixed;
    bottom: 0;
    padding: inherit;
}

.alert-info {
    background-color: red;
    border: none;
    color: white;
    width: 70vw;
}
</style>