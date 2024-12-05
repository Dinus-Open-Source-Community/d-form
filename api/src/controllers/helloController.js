const helloHandler = (req, res) => {
    res.status(200).json({
        message: 'Hello world!',
    });
};

module.exports = { helloHandler };
