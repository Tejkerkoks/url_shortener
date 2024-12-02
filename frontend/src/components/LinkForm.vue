<template>
  <div>
    <h1>Skracacz linków</h1>
    <form @submit.prevent="shortenUrl">
      <input type="text" v-model="originalUrl"/>
      <button type="submit">Skróć link</button>
    </form>
    <div v-if="shortenedUrl">
      <p>Skrócony URL: <a :href="shortenedUrl" target="_blank">{{ shortenedUrl }}</a></p>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      originalUrl: '',
      shortenedUrl: ''
    };
  },
  methods: {
    async shortenUrl() {
      try {
        const response = await axios.post('http://localhost/api/links', {
          original_url: this.originalUrl
        });
        this.shortenedUrl = `http://localhost/${response.data.shortened_url}`;
      } catch (error) {
        console.error('Błąd przy skracaniu linku', error);
      }
    }
  }
};
</script>

<style scoped>
input {
  margin-right: 10px;
}
</style>
