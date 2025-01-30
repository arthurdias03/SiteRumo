/*<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Primeiro, obtenha o caminho do arquivo para excluí-lo do servidor
    $sql = "SELECT caminho_arquivo FROM arquivos WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $caminhoArquivo = $row['caminho_arquivo'];

        // Tente excluir o arquivo físico
        if (file_exists($caminhoArquivo)) {
            unlink($caminhoArquivo);
        }

        // Agora, exclua o registro do banco de dados
        $sql = "DELETE FROM arquivos WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            echo "Arquivo excluído com sucesso.";
        } else {
            echo "Erro ao excluir o arquivo: " . $conn->error;
        }
    } else {
        echo "Arquivo não encontrado.";
    }
} else {
    echo "ID do arquivo não fornecido.";
}

$conn->close();
?>
