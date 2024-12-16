<template>
  <v-container
    fluid
    class="d-flex ga-6 align-start mb-4 flex-wrap justify-between px-0"
  >
    <v-textarea
      v-model="search.global"
      label="Найти"
      variant="outlined"
      prepend-inner-icon="mdi-magnify"
      single-line
      hide-details
      rounded
      rows="1"
      auto-grow
      clearable
      maxlength="600"
      min-width="300"
      density="compact"
      max-rows="4"
      @click:clear="clearGlobalSearch"
    />
    <v-autocomplete
      v-model="website"
      label="Websites"
      :items="websites"
      variant="outlined"
      density="compact"
      placeholder="Website"
      hide-details
      rounded
      clearable
      single-line
      min-width="150"
      class="border-none ring-0"
    ></v-autocomplete>
    <v-btn
      icon="mdi mdi-refresh"
      variant="outlined"
      density="comfortable"
      v-if="!$vuetify.display.mdAndUp"
      :disabled="loading"
      @click="refreshData"
    ></v-btn>
    <v-btn
      v-if="$vuetify.display.mdAndUp"
      :disabled="loading"
      rounded
      append-icon="mdi-refresh"
      text="Обновить"
      variant="outlined"
      @click="refreshData"
    ></v-btn>
  </v-container>
  <v-data-table
    :items="filteredFeedbacks"
    :headers="headers"
    :search="search.global"
    v-model:pagination="pagination"
    :total-items="totalFeedbacks"
    :loading="loading"
    :items-per-page="pagination.itemsPerPage"
    color="primary"
    class="elevation-3"
    fixed-header
    height="70vh"
    max-rows="5"
  >
    <template v-slot:body="{ items }">
      <tr class="my-2">
        <td v-for="header in headers" :key="'search-' + header.key">
          <v-icon v-if="header.key === 'id'" icon="mdi-magnify" />
          <v-menu
            v-else-if="header.key === 'created_at'"
            v-model="menu"
            :close-on-content-click="false"
            max-width="auto"
            transition="scale-transition"
          >
            <template #activator="{ props }">
              <v-text-field
                v-bind="props"
                v-model="formattedSearchDate"
                label="Дата"
                variant="outlined"
                hide-details
                dense
                single-line
                rounded
                clearable
                readonly
                density="compact"
                style="min-width: 150px"
                @click:clear="search.created_at = null"
              />
            </template>
            <v-date-picker v-model="date" />
          </v-menu>
          <v-text-field
            v-else
            v-model="search[header.key]"
            :placeholder="header.title"
            variant="outlined"
            hide-details
            dense
            single-line
            rounded
            clearable
            density="compact"
            style="min-width: 150px"
            @click:clear="clearField(header.key)"
          />
        </td>
      </tr>
      <tr v-for="item in items" :key="item.id">
        <td>{{ item.id }}</td>
        <td style="max-width: 200px">{{ item.name }}</td>
        <td class="text-xs-right">
          <b>{{ item.email }}</b>
        </td>
        <td class="text-xs-right" style="white-space: nowrap">
          <a :href="'tel:' + item.phone_number.trim()" class="text-blue">
            {{ item.phone_number }}
          </a>
        </td>
        <td
          style="cursor: pointer"
          @click="openDialog(item.message, item.name)"
        >
          <v-tooltip bottom>
            <template #activator="{ on, attrs }">
              <span class="text-truncate" v-bind="attrs" v-on="on"
              >
                "{{ item.message }}"
              </span>
            </template>
          </v-tooltip>
        </td>
        <td class="text-xs-right">
          <v-chip>
            {{ formattedDate(item.created_at) }}
          </v-chip>
        </td>
        <td class="text-xs-right">
          <a
            :href="
              item.website.startsWith('http')
                ? item.website
                : `https://${item.website}`
            "
            target="_blank"
            rel="noopener noreferrer"
            class="text-blue"
          >
            {{ item.website }}
          </a>
        </td>
        <td class="text-xs-right">
          {{ item.ip_address ? item.ip_address : 'localhost' }}
        </td>
      </tr>
    </template>
  </v-data-table>
  <v-dialog
    v-model="dialog"
    max-width="600px"
  >
    <v-card>
      <v-card-title class="headline">
        Вопрос от <b>{{ messageAdresat }}</b>
      </v-card-title>
      <v-card-text>{{ fullText }}</v-card-text>
      <v-card-actions>
        <v-btn
          color="primary"
          rounded
          @click="dialog = false"
        >
          Закрыть
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script setup>
import { ref, watch, onMounted, defineProps, computed, inject } from 'vue';

const props = defineProps({
  feedbacksData: Array,
  websites: Array,
});

const emit = defineEmits(['refresh-data']);

const website = ref(null);

const menu = ref(false);

const totalFeedbacks = ref(0);

const feedbacks = ref([]);

const loading = ref(true);

const date = ref(null);

const dialog = ref(false);

const fullText = ref('');

const messageAdresat = ref('');

const refreshData = () => emit('refresh-data');

const search = ref({
  global: '',
  name: '',
  email: '',
  phone_number: '',
  message: '',
  created_at: null,
  website: '',
  ip_address: '',
});

const pagination = ref({
  sortBy: '',
  descending: false,
  page: 1,
  itemsPerPage: 25,
});

const headers = ref([
  { title: '№', align: 'left', sortable: true, key: 'id' },
  { title: 'Имя', align: 'left', sortable: true, key: 'name', minWidth: '100px'},
  { title: 'Email', align: 'left', sortable: true, key: 'email' },
  { title: 'Телефон', align: 'left', sortable: true, key: 'phone_number' },
  { title: 'Вопрос', align: 'left', sortable: true, key: 'message' },
  { title: 'Дата', align: 'left', sortable: true, key: 'created_at' },
  { title: 'website', align: 'left', sortable: true, key: 'website' },
  { title: 'IP', align: 'left', sortable: true, key: 'ip_address' },
]);

const formattedDate = (currentDate) =>
  new Date(currentDate).toLocaleDateString('ru-RU', {
    day: '2-digit',
    month: '2-digit',
    year: 'numeric',
  });

const formattedSearchDate = computed(() => {
  return search.value.created_at
    ? new Intl.DateTimeFormat('ru-RU').format(search.value.created_at)
    : '';
});

const openDialog = (message, name) => {
  fullText.value = message;
  dialog.value = true;
  messageAdresat.value = name;
};

const clearGlobalSearch = () => {
  search.value.global = '';
};

const clearField = (field) => {
  search.value[field] = '';
};

const getDataFromApi = () => {
  loading.value = true;

  const { sortBy, descending, page, itemsPerPage } = pagination.value;

  let items = props.feedbacksData;
  const total = items.length;

  if (sortBy) {
    items = items.sort((a, b) => {
      const sortA = a[sortBy];
      const sortB = b[sortBy];

      if (descending) {
        return sortA < sortB ? 1 : sortA > sortB ? -1 : 0;
      } else {
        return sortA < sortB ? -1 : sortA > sortB ? 1 : 0;
      }
    });
  }

  if (itemsPerPage > 0) {
    items = items.slice((page - 1) * itemsPerPage, page * itemsPerPage);
  }

  setTimeout(() => {
    feedbacks.value = items;
    totalFeedbacks.value = total;
    loading.value = false;
  }, 500);
};

const filteredFeedbacks = computed(() => {
  return props.feedbacksData.filter((item) => {
    const searchText = search.value.global.toLowerCase();

    if (
      searchText &&
      !Object.keys(search.value).some((key) => {
        const value = String(item[key]).toLowerCase();
        return value.includes(searchText);
      })
    ) {
      return false;
    }

    const matchesSearch = Object.keys(search.value).every((key) => {
      if (key === 'global') return true;
      if (key === 'created_at') {
        return search.value.created_at
          ? new Date(item.created_at).toDateString() ===
              search.value.created_at.toDateString()
          : true;
      }
      const value = String(item[key]).toLowerCase();
      return search.value[key]
        ? value.includes(search.value[key].toLowerCase())
        : true;
    });

    const matchesWebsite = !website.value || item.website === website.value;

    return matchesSearch && matchesWebsite;
  });
});

onMounted(() => {
  getDataFromApi();
});

watch(
  pagination,
  () => {
    getDataFromApi();
  },
  { deep: true },
);

watch(date, (newDate) => {
  if (newDate) {
    search.value.created_at = new Date(newDate);
  } else {
    search.value.created_at = null;
  }
});
</script>

<style scoped lang="scss">
.text-truncate {
  display: inline-block;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  max-width: 250px;
}

.no-tailwind-styles .v-input {
  border: none;
  box-shadow: none;
}
</style>
