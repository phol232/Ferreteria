import { defineConfig } from 'vite';

export default defineConfig({
  server: {
    host: '0.0.0.0',
    port: 4200,
    allowedHosts: [
      'sociofro.tecno-express.shop',
      '143.110.226.214',
      'localhost'
    ]
  }
});
