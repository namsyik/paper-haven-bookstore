#!/bin/bash

# Script to download book cover images
# Uses Open Library Covers API

cd "$(dirname "$0")/public/images/books"

echo "Downloading book cover images..."

# Function to download cover by ISBN
download_cover() {
    local isbn=$1
    local filename=$2
    local url="https://covers.openlibrary.org/b/isbn/${isbn}-L.jpg"
    
    curl -s "$url" -o "$filename"
    
    if [ -f "$filename" ] && [ -s "$filename" ]; then
        echo "✓ Downloaded: $filename"
    else
        echo "✗ Failed: $filename (using placeholder)"
        # Create a colored placeholder instead
        convert -size 300x450 xc:"#8B6F47" -pointsize 20 -fill white -gravity center \
                -annotate +0+0 "$(basename $filename .jpg)" "$filename" 2>/dev/null || true
    fi
}

# Download covers for each book
download_cover "9780735211292" "atomic-habits.jpg"
download_cover "9780143130727" "ikigai.jpg"
download_cover "9781544514222" "almanack-naval.jpg"
download_cover "9780553383713" "emotional-intelligence.jpg"
download_cover "9780071418638" "how-to-talk.jpg"
download_cover "9780399144462" "who-moved-cheese.jpg"
download_cover "9780857197689" "psychology-money.jpg"
download_cover "9781585424337" "think-grow-rich.jpg"
download_cover "9781585424542" "law-of-success.jpg"
download_cover "9781454900672" "outwitting-devil.jpg"
download_cover "9781612680194" "rich-dad-poor-dad.jpg"
download_cover "9781612680057" "cashflow-quadrant.jpg"
download_cover "9780446617437" "retire-young.jpg"
download_cover "9781576754221" "eat-that-frog.jpg"
download_cover "9781576753077" "goals.jpg"
download_cover "9780785288312" "psychology-selling.jpg"
download_cover "9781982137274" "7-habits.jpg"
download_cover "9780062457714" "subtle-art.jpg"
download_cover "9780345816023" "12-rules.jpg"
download_cover "9781544512273" "cant-hurt-me.jpg"
download_cover "9781577314806" "power-of-now.jpg"
download_cover "9780062316110" "sapiens.jpg"
download_cover "9781878424310" "four-agreements.jpg"
download_cover "9780451205360" "richest-man-babylon.jpg"
download_cover "9781455586691" "deep-work.jpg"
download_cover "9781591846444" "start-with-why.jpg"
download_cover "9780307887894" "lean-startup.jpg"
download_cover "9780345472328" "mindset.jpg"
download_cover "9781501111105" "grit.jpg"

echo ""
echo "Book cover download complete!"
