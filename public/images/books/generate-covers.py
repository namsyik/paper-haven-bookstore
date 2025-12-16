#!/usr/bin/env python3
from PIL import Image, ImageDraw, ImageFont
import textwrap

def create_book_cover(title, author, filename, color):
    # Create image
    width, height = 300, 450
    img = Image.new('RGB', (width, height), color=color)
    draw = ImageDraw.Draw(img)
    
    # Try to use a nice font, fallback to default
    try:
        title_font = ImageFont.truetype("/usr/share/fonts/truetype/dejavu/DejaVuSans-Bold.ttf", 28)
        author_font = ImageFont.truetype("/usr/share/fonts/truetype/dejavu/DejaVuSans.ttf", 18)
    except:
        title_font = ImageFont.load_default()
        author_font = ImageFont.load_default()
    
    # Wrap title text
    title_lines = textwrap.wrap(title, width=20)
    
    # Draw title
    y_text = 100
    for line in title_lines:
        bbox = draw.textbbox((0, 0), line, font=title_font)
        text_width = bbox[2] - bbox[0]
        x = (width - text_width) // 2
        draw.text((x, y_text), line, font=title_font, fill='white')
        y_text += 40
    
    # Draw author
    author_text = f"by {author}"
    bbox = draw.textbbox((0, 0), author_text, font=author_font)
    text_width = bbox[2] - bbox[0]
    x = (width - text_width) // 2
    draw.text((x, height - 80), author_text, font=author_font, fill='white')
    
    # Add decorative border
    draw.rectangle([10, 10, width-10, height-10], outline='white', width=3)
    
    img.save(filename, 'JPEG', quality=95)
    print(f"Created: {filename}")

# Book covers with different colors
books = [
    ("Atomic Habits", "James Clear", "atomic-habits.jpg", "#2C3E50"),
    ("Ikigai", "Héctor García", "ikigai.jpg", "#E74C3C"),
    ("The Almanack of Naval Ravikant", "Eric Jorgenson", "almanack-naval.jpg", "#3498DB"),
    ("Emotional Intelligence", "Daniel Goleman", "emotional-intelligence.jpg", "#9B59B6"),
    ("How to Talk to Anyone", "Leil Lowndes", "how-to-talk.jpg", "#F39C12"),
    ("Who Moved My Cheese?", "Spencer Johnson", "who-moved-cheese.jpg", "#E67E22"),
    ("The Psychology of Money", "Morgan Housel", "psychology-money.jpg", "#16A085"),
    ("Think and Grow Rich", "Napoleon Hill", "think-grow-rich.jpg", "#C0392B"),
    ("The Law of Success", "Napoleon Hill", "law-of-success.jpg", "#8E44AD"),
    ("Outwitting the Devil", "Napoleon Hill", "outwitting-devil.jpg", "#2C3E50"),
    ("Rich Dad Poor Dad", "Robert Kiyosaki", "rich-dad-poor-dad.jpg", "#D35400"),
    ("Cashflow Quadrant", "Robert Kiyosaki", "cashflow-quadrant.jpg", "#27AE60"),
    ("Retire Young Retire Rich", "Robert Kiyosaki", "retire-young.jpg", "#2980B9"),
    ("Eat That Frog!", "Brian Tracy", "eat-that-frog.jpg", "#16A085"),
    ("Goals!", "Brian Tracy", "goals.jpg", "#C0392B"),
    ("The Psychology of Selling", "Brian Tracy", "psychology-selling.jpg", "#8E44AD"),
    ("The 7 Habits of Highly Effective People", "Stephen Covey", "7-habits.jpg", "#34495E"),
    ("The Subtle Art of Not Giving a F*ck", "Mark Manson", "subtle-art.jpg", "#E74C3C"),
    ("12 Rules for Life", "Jordan Peterson", "12-rules.jpg", "#2C3E50"),
    ("Can't Hurt Me", "David Goggins", "cant-hurt-me.jpg", "#C0392B"),
    ("The Power of Now", "Eckhart Tolle", "power-of-now.jpg", "#F39C12"),
    ("Sapiens", "Yuval Noah Harari", "sapiens.jpg", "#E67E22"),
    ("The Four Agreements", "Don Miguel Ruiz", "four-agreements.jpg", "#3498DB"),
    ("The Richest Man in Babylon", "George S. Clason", "richest-man-babylon.jpg", "#D4AF37"),
    ("Deep Work", "Cal Newport", "deep-work.jpg", "#2C3E50"),
    ("Start with Why", "Simon Sinek", "start-with-why.jpg", "#E74C3C"),
    ("The Lean Startup", "Eric Ries", "lean-startup.jpg", "#16A085"),
    ("Mindset", "Carol S. Dweck", "mindset.jpg", "#9B59B6"),
    ("Grit", "Angela Duckworth", "grit.jpg", "#E67E22"),
    ("James Clear Newsletter", "James Clear", "james-clear-newsletter.jpg", "#2C3E50"),
]

for title, author, filename, color in books:
    create_book_cover(title, author, filename, color)

print(f"\nGenerated {len(books)} book covers!")
