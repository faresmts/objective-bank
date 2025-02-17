#!/usr/bin/zsh

echo "🚀 Iniciando o ambiente Docker..."

if ! command -v docker &> /dev/null; then
    echo "❌ Docker não está instalado. Por favor, instale o Docker e tente novamente."
    exit 1
fi

if ! docker info &> /dev/null; then
    echo "❌ Docker não está rodando. Inicie o Docker e tente novamente."
    exit 1
fi

echo "🧹 Removendo containers antigos..."
docker compose down

echo "🔧 Configurando variáveis de ambiente..."
rm -rf .env
cp .env.example .env

echo "🐳 Construindo e subindo os containers..."
docker compose up -d --build

sleep 5

echo "📜 Exibindo logs dos containers..."
docker compose logs --tail=20

echo "✅ Containers ativos:"
docker ps --format "table {{.Names}}\t{{.Status}}"

echo "🚦 Configurando o ambiente da aplicação..."
docker compose exec laravel.test php artisan migrate:fresh --force
docker compose exec laravel.test php artisan key:generate --force

echo "🎉 Ambiente iniciado com sucesso!"
