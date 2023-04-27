<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Words</div>

                <div class="card-body">
                    <p v-for="(word, idx) in wordlist" v-bind:key="idx">
                        <span @click="wordClick(idx)">{{word.group_id}} &mdash; {{word.word}}</span>
                        <!-- <span v-show="word.showDef" class="def">{{word.definition}}</span> -->
                        <button v-show="word.learned==false" @click="yes(idx)" class="yes btn btn-success btn-sm">Yes</button>
                        <button class="no btn btn-danger btn-sm">No</button>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <span v-show="showDef" class="definition">{{def}}</span>
</div>

</template>

<script>

	export default {
        props: {
            wordlist:[],
        },
		data () {
			return {
                def: '',
                showDef:false,
			}
		},
		methods: {
            async yes(idx) {
                await fetch('http://localhost:8000/api/learned/'+this.wordlist[idx].id, {
                        method: 'put',
                        body: JSON.stringify(this.wordlist[idx]),
                        headers: {
                            'content-type': 'application/json'
                        }
                    })
                this.wordlist[idx].learned = true;
            },
            wordClick(idx) {
                this.wordlist[idx].showDef = !this.wordlist[idx].showDef;
                this.showDef = this.wordlist[idx].showDef;
                if (this.wordlist[idx].showDef){
                    this.def = this.wordlist[idx].definition;
                } else {
                    this.def = '';
                }
            }
		},
		created() {

		},
	}
</script>

<style lang="scss" scoped>
    .definition {
        position:fixed;
        right:0;
        top:130px;
        width:50%;
        padding:25px 0;
        z-index: 10;
        text-align: center;
        background-color: rgba(202, 193, 193, 0.158);
        border:2px solid #000;
        font-size:25px;
    }
</style>
