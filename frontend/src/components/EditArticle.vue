<template>
    <div>
      <h1>Contact List</h1>
      <ul>
        <li v-for="contact in contacts" :key="contact.id">
          {{ contact.name }} - {{ contact.phone }}
        </li>
      </ul>
    </div>
  </template>

  <script>
  import axios from 'axios';

  export default {
    data() {
      return {
        contacts: []
      };
    },
    mounted() {
      this.fetchContacts();
    },
    methods: {
      async fetchContacts() {
        try {
          const response = await axios.get('../api/contacts');
          this.contacts = response.data;
        } catch (error) {
          console.error('Error fetching contacts:', error);
        }
      }
    }
  };
  </script>
