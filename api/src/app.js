const express = require('express');
const morgan = require('morgan');
const cors = require('cors');
const helmet = require('helmet');
const routes = require('./routes/routes');
const { errorHandler } = require('./middlewares/errorHandler');

const app = express();

// Middleware
app.use(morgan('dev'));
app.use(cors());
app.use(helmet());
app.use(express.json());
app.use(express.urlencoded({ extended: false }));

// Routes
app.use('/api/v1', routes);

// Error Handling Middleware
app.use(errorHandler);

module.exports = app;
