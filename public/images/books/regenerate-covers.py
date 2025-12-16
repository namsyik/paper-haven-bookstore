#!/usr/bin/env python3
from PIL import Image, ImageDraw, ImageFont
import textwrap

def create_simple_cover(title, filename, color):
    """Create simple, beautiful book cover"""
    width, height = 300, 450
    img = Image.new('RGB', (width, height), color=color)
    draw = ImageDraw.Draw(img)
    
    try:
        title_font = ImageFont.truetype("/usr/share/fonts/truetype/dejavu/DejaVuSans-Bold.ttf", 32)
    except:
        title_font = ImageFont.load_default()
    
    # Wrap title
    title_lines = textwrap.wrap(title, width=15)
    
    # Calculate total height
    total_height = len(title_lines) * 45
    start_y = (height - total_height) // 2
    
    # Draw each line
    for i, line in enumerate(title_lines[:3]):  # Max 3 lines
        bbox = draw.textbbox((0, 0), line, font=title_font)
        text_width = bbox[2] - bbox[0]
        x = (width - text_width) // 2
        y = start_y + (i * 45)
        
        # Add shadow
        draw.text((x+2, y+2), line, font=title_font, fill=(0, 0, 0, 128))
        draw.text((x, y), line, font=title_font, fill='white')
    
    # Border
    draw.rectangle([15, 15, width-15, height-15], outline='white', width=4)
    
    img.save(filename, 'JPEG', quality=95)
    print(f"✓ {filename}")

books = [
    ("Atomic Habits", "atomic-habits.jpg", "#1e3a8a"),
    ("Ikigai", "ikigai.jpg", "#dc2626"),
    ("Naval's Almanack", "almanack-naval.jpg", "#2563eb"),
    ("Emotional Intelligence", "emotional-intelligence.jpg", "#7c3aed"),
    ("How to Talk", "how-to-talk.jpg", "#ea580c"),
    ("Who Moved My Cheese", "who-moved-cheese.jpg", "#d97706"),
    ("Psychology of Money", "psychology-money.jpg", "#059669"),
    ("Think & Grow Rich", "think-grow-rich.jpg", "#991b1b"),
    ("Law of Success", "law-of-success.jpg", "#6b21a8"),
    ("Outwitting Devil", "outwitting-devil.jpg", "#1e293b"),
    ("Rich Dad Poor Dad", "rich-dad-poor-dad.jpg", "#c2410c"),
    ("Cashflow Quadrant", "cashflow-quadrant.jpg", "#16a34a"),
    ("Retire Young Rich", "retire-young.jpg", "#1d4ed8"),
    ("Eat That Frog", "eat-that-frog.jpg", "#0d9488"),
    ("Goals!", "goals.jpg", "#b91c1c"),
    ("Psychology Selling", "psychology-selling.jpg", "#7c3aed"),
    ("7 Habits", "7-habits.jpg", "#334155"),
    ("Subtle Art", "subtle-art.jpg", "#dc2626"),
    ("12 Rules", "12-rules.jpg", "#1e3a8a"),
    ("Can't Hurt Me", "cant-hurt-me.jpg", "#991b1b"),
    ("Power of Now", "power-of-now.jpg", "#d97706"),
    ("Sapiens", "sapiens.jpg", "#ea580c"),
    ("Four Agreements", "four-agreements.jpg", "#2563eb"),
    ("Richest Man", "richest-man-babylon.jpg", "#b45309"),
    ("Deep Work", "deep-work.jpg", "#1e293b"),
    ("Start with Why", "start-with-why.jpg", "#dc2626"),
    ("Lean Startup", "lean-startup.jpg", "#059669"),
    ("Mindset", "mindset.jpg", "#7c3aed"),
    ("Grit", "grit.jpg", "#ea580c"),
    ("Newsletter", "james-clear-newsletter.jpg", "#1e3a8a"),
]

for title, filename, color in books:
    create_simple_cover(title, filename, color)

print(f"\n✓ Generated {len(books)} covers")
