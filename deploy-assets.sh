#!/bin/bash
# Script to ensure landing CSS/JS files exist in production

# Colors for output
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m' # No Color

echo -e "${YELLOW}Checking and deploying landing assets...${NC}"

# Get the script directory (should be in Laravel root)
SCRIPT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
PUBLIC_ASSETS_DIR="$SCRIPT_DIR/public/assets"
ROOT_ASSETS_DIR="$SCRIPT_DIR/assets"

# Create public/assets/landing directory if it doesn't exist
mkdir -p "$PUBLIC_ASSETS_DIR/landing"

# Check if files exist in root assets and copy if needed
if [ -f "$ROOT_ASSETS_DIR/style.css" ] && [ ! -f "$PUBLIC_ASSETS_DIR/landing/style.css" ]; then
    echo -e "${YELLOW}Copying style.css from root assets...${NC}"
    cp "$ROOT_ASSETS_DIR/style.css" "$PUBLIC_ASSETS_DIR/landing/style.css"
fi

if [ -f "$ROOT_ASSETS_DIR/script.js" ] && [ ! -f "$PUBLIC_ASSETS_DIR/landing/script.js" ]; then
    echo -e "${YELLOW}Copying script.js from root assets...${NC}"
    cp "$ROOT_ASSETS_DIR/script.js" "$PUBLIC_ASSETS_DIR/landing/script.js"
fi

# Verify files exist
if [ -f "$PUBLIC_ASSETS_DIR/landing/style.css" ] && [ -f "$PUBLIC_ASSETS_DIR/landing/script.js" ]; then
    echo -e "${GREEN}✓ Landing assets are ready!${NC}"
    echo -e "  - $PUBLIC_ASSETS_DIR/landing/style.css"
    echo -e "  - $PUBLIC_ASSETS_DIR/landing/script.js"
else
    echo -e "${RED}✗ Error: Landing assets not found!${NC}"
    echo -e "  Please ensure files exist in:"
    echo -e "  - $PUBLIC_ASSETS_DIR/landing/style.css"
    echo -e "  - $PUBLIC_ASSETS_DIR/landing/script.js"
    exit 1
fi

# Also ensure lanal assets are accessible
if [ -d "$ROOT_ASSETS_DIR/lanal" ]; then
    if [ ! -d "$PUBLIC_ASSETS_DIR/lanal" ]; then
        echo -e "${YELLOW}Copying lanal assets...${NC}"
        cp -r "$ROOT_ASSETS_DIR/lanal" "$PUBLIC_ASSETS_DIR/"
    fi
    echo -e "${GREEN}✓ Lanal assets are ready!${NC}"
fi

echo -e "${GREEN}Done!${NC}"

