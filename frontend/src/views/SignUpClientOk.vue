<script setup>
import SiteHeader from './SiteHeader.vue';</script>
<template>
  <div class="col-lg-8 mx-auto p-4 py-md-5">
    <SiteHeader/>
    <main>
      <div class="text-left w-100 m-auto">
        <h1>Jesus Christ it works</h1>

        <p class="fs-5 col-md-8">
          - The log file is stored in <b>./backend/data/</b> in the folder added .gitignore to
          all files from this directory were ignored by git
          <br>- Response from api in JSend specification format
          <br>- Other examples of works on <a href="https://github.com/timtimosh" target="_blank">GitHub</a>
        </p>
        <div class="mb-5">
          <router-link class="btn btn-primary btn-lg px-4" :to="'/'">Back to signUp</router-link>
        </div>
      </div>
    </main>
  </div>
</template>