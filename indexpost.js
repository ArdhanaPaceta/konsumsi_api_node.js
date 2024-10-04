const express = require('express');
const axios = require('axios');
const app = express();
const port = 4000;

// Middleware untuk melayani file statis
app.use(express.static('public')); // Public folder untuk file statis seperti CSS

// Mengambil data dari API JSON Placeholder
app.get('/', async (req, res) => {
    try {
        const response = await axios.get('https://jsonplaceholder.typicode.com/posts');
        const data = response.data;

        // Mendapatkan query parameters untuk filter
        const filterId = req.query.id ? parseInt(req.query.id) : null;
        const filterTitle = req.query.title ? req.query.title.toLowerCase() : null;

        // Memfilter data berdasarkan id dan title jika query parameter ada
        const filteredData = data.filter(post => {
            const idMatch = filterId ? post.id === filterId : true;
            const titleMatch = filterTitle ? post.title.toLowerCase().includes(filterTitle) : true;
            return idMatch && titleMatch;
        });

        let tableHTML = `
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Data Posts (Node.js)</title>
            <link rel="stylesheet" href="/stlyee.css"> 
        </head>
        <body>
            <h1>Data Posts dari JSON Placeholder API (Node.js)</h1>
            <form>
                <label for="id">Filter by ID:</label>
                <input type="number" id="id" name="id" value="${filterId || ''}">
                <label for="title">Filter by Title:</label>
                <input type="text" id="title" name="title" value="${filterTitle || ''}">
                <button type="submit">Filter</button>
            </form>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Body</th>
                    </tr>
                </thead>
                <tbody>`;

        // Menampilkan data yang difilter
        filteredData.forEach(post => {
            tableHTML += `
            <tr>
                <td>${post.id}</td>
                <td>${post.title}</td>
                <td>${post.body}</td>
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
    console.log(`Server berjalan di http://localhost:${port}`);
}); 
