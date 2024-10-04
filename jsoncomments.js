const express = require('express');
const axios = require('axios');
const app = express();
const port = 4000;


// Middleware untuk melayani file statis
app.use(express.static('public')); // Public folder untuk file statis seperti CSS

// Mengambil data dari API JSON Placeholder
app.get('/', async (req, res) => {
    try {
        const response = await axios.get('https://jsonplaceholder.typicode.com/comments');
        const data = response.data;

        let tableHTML = `
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Data Posts (Node.js)</title>
            <link rel="stylesheet" href="stlyee.css">
        </head>
        <body>
            <h1>Data Comments dari JSON Placeholder API (Node.js)</h1>
            <table> 
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>nama</th>
                        <th>email</th>
                        <th>Body</th>
                    </tr>
                </thead>
                <tbody>`;

        data.forEach(comments => {
            tableHTML += `
            <tr>
                <td>${comments.id}</td>
                <td>${comments.name}</td>
                <td>${comments.email}</td>
                <td>${comments.body}</td>
            </tr>`;
        });

        tableHTML += `
                </tbody>
            </table>
        </body>
        </html>`;
        
        res.send(tableHTML);
    } catch (error) {
        res.status(500).send('Error fetching data');
    }
});

// Menjalankan server
app.listen(port, () => {
    console.log('Server berjalan di http://localhost:${port}');
});