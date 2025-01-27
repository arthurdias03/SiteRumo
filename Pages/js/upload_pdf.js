const express = require('express');
const multer = require('multer');
const path = require('path');
const fs = require('fs');

const app = express();

// Diretório base onde os PDFs serão armazenados
const baseDir = './PDFs';

// Função para criar diretórios se não existirem
const createDirectories = () => {
  const directories = [
    baseDir,
    path.join(baseDir, 'Teses'),
    path.join(baseDir, 'Dissertações'),
    path.join(baseDir, 'Artigos'),
  ];

  directories.forEach((dir) => {
    if (!fs.existsSync(dir)) {
      fs.mkdirSync(dir);
    }

    for (let i = 2020; i <= 2024; i++) {
      const subDir = path.join(dir, i.toString());
      if (!fs.existsSync(subDir)) {
        fs.mkdirSync(subDir);
      }
    }
  });
};

createDirectories();

// Configuração do armazenamento
const storage = multer.diskStorage({
  destination: function (req, file, cb) {
    const { folder, subfolder } = req.body;
    const uploadPath = path.join(baseDir, folder, subfolder);
    cb(null, uploadPath);
  },
  filename: function (req, file, cb) {
    // Nome do arquivo dentro da pasta
    cb(null, file.fieldname + '-' + Date.now() + path.extname(file.originalname));
  }
});

// Middleware para upload de arquivos
const upload = multer({ storage: storage });

// Rota para upload de PDF
app.post('/Pages/PDFs', upload.single('pdf'), (req, res) => {
  res.send('Arquivo PDF enviado com sucesso!');
});

// Rota para o formulário de upload
app.get('/Pages/Upload-PDF.html', (req, res) => {
  res.sendFile(path.join(__dirname, '/Pages/Upload-PDF.html'));
});

app.listen(3000, () => {
  console.log('Servidor rodando na porta 3000');
});
