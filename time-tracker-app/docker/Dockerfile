FROM node:16

WORKDIR /usr/src/app

# Install dependencies
COPY package*.json ./
RUN yarn install

# Copy application files
COPY . .

# Expose port 8080
EXPOSE 8080

# Start Vue.js app
CMD ["yarn", "run", "serve"]
