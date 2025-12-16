#!/usr/bin/env python3
import urllib.request
import time

def download_cover(isbn, filename):
    """Download book cover from Open Library API"""
    url = f"https://covers.openlibrary.org/b/isbn/{isbn}-L.jpg"
    try:
        print(f"Downloading {filename}...")
        urllib.request.urlretrieve(url, filename)
        # Check if file is valid (more than 1KB)
        import os
        if os.path.getsize(filename) > 1000:
            print(f"✓ Success: {filename}")
            return True
        else:
            print(f"✗ Invalid: {filename}")
            return False
    except Exception as e:
        print(f"✗ Failed: {filename} - {e}")
        return False
    finally:
        time.sleep(0.2)  # Rate limiting

# Real ISBN numbers for actual books
books = [
    ("9780735211292", "atomic-habits.jpg"),
    ("9780143130727", "ikigai.jpg"),
    ("9781544514222", "almanack-naval.jpg"),
    ("9780553383713", "emotional-intelligence.jpg"),
    ("9780071418638", "how-to-talk.jpg"),
    ("9780399144462", "who-moved-cheese.jpg"),
    ("9780857197689", "psychology-money.jpg"),
    ("9781585424337", "think-grow-rich.jpg"),
    ("9781585424542", "law-of-success.jpg"),
    ("9781454900672", "outwitting-devil.jpg"),
    ("9781612680194", "rich-dad-poor-dad.jpg"),
    ("9781612680057", "cashflow-quadrant.jpg"),
    ("9780446617437", "retire-young.jpg"),
    ("9781576754221", "eat-that-frog.jpg"),
    ("9781576753077", "goals.jpg"),
    ("9780785288312", "psychology-selling.jpg"),
    ("9781982137274", "7-habits.jpg"),
    ("9780062457714", "subtle-art.jpg"),
    ("9780345816023", "12-rules.jpg"),
    ("9781544512273", "cant-hurt-me.jpg"),
    ("9781577314806", "power-of-now.jpg"),
    ("9780062316110", "sapiens.jpg"),
    ("9781878424310", "four-agreements.jpg"),
    ("9780451205360", "richest-man-babylon.jpg"),
    ("9781455586691", "deep-work.jpg"),
    ("9781591846444", "start-with-why.jpg"),
    ("9780307887894", "lean-startup.jpg"),
    ("9780345472328", "mindset.jpg"),
    ("9781501111105", "grit.jpg"),
    ("9780735212299", "james-clear-newsletter.jpg"),
]

success = 0
failed = 0

for isbn, filename in books:
    if download_cover(isbn, filename):
        success += 1
    else:
        failed += 1

print(f"\n✓ Successfully downloaded: {success}")
print(f"✗ Failed: {failed}")
