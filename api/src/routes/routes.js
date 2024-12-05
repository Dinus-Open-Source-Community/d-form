const express = require('express');
const { helloHandler } = require('../controllers/helloController');

const router = express.Router();

router.get('/hello', helloHandler);

module.exports = router;
