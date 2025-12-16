<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            // Featured Books from screenshot
            [
                'title' => 'Atomic Habits',
                'author' => 'James Clear',
                'description' => 'An Easy & Proven Way to Build Good Habits & Break Bad Ones. Tiny Changes, Remarkable Results. No matter your goals, Atomic Habits offers a proven framework for improving every day.',
                'price' => 32.00,
                'image' => 'atomic-habits.jpg',
                'stock' => 50,
                'isbn' => '9780735211292',
                'rating' => 4.9,
                'category' => 'Self-Help'
            ],
            [
                'title' => 'Ikigai',
                'author' => 'Héctor García & Francesc Miralles',
                'description' => 'The Japanese Secret to a Long and Happy Life. Discover the Japanese concept of Ikigai and find your reason for being.',
                'price' => 32.00,
                'image' => 'ikigai.jpg',
                'stock' => 45,
                'isbn' => '9780143130727',
                'rating' => 4.8,
                'category' => 'Philosophy'
            ],
            [
                'title' => 'The Almanack of Naval Ravikant',
                'author' => 'Eric Jorgenson',
                'description' => 'A Guide to Wealth and Happiness. Naval Ravikant is an entrepreneur, philosopher, and investor who has captivated the world with his principles for building wealth and creating long-term happiness.',
                'price' => 32.00,
                'image' => 'almanack-naval.jpg',
                'stock' => 40,
                'isbn' => '9781544514222',
                'rating' => 4.9,
                'category' => 'Business'
            ],
            
            // Recommended Books
            [
                'title' => 'Emotional Intelligence',
                'author' => 'Daniel Goleman',
                'description' => 'Why It Can Matter More Than IQ. Everyone knows that high IQ is no guarantee of success, happiness, or virtue, but until Emotional Intelligence, we could only guess why.',
                'price' => 32.00,
                'image' => 'emotional-intelligence.jpg',
                'stock' => 35,
                'isbn' => '9780553383713',
                'rating' => 4.9,
                'category' => 'Psychology'
            ],
            [
                'title' => 'How to Talk to Anyone',
                'author' => 'Leil Lowndes',
                'description' => '92 Little Tricks for Big Success in Relationships. What is that magic quality makes some people instantly loved and respected?',
                'price' => 32.00,
                'image' => 'how-to-talk.jpg',
                'stock' => 30,
                'isbn' => '9780071418638',
                'rating' => 4.9,
                'category' => 'Communication'
            ],
            [
                'title' => 'Who Moved My Cheese?',
                'author' => 'Spencer Johnson',
                'description' => 'An Amazing Way to Deal with Change in Your Work and in Your Life. A timeless business classic that has helped millions of people around the world.',
                'price' => 32.00,
                'image' => 'who-moved-cheese.jpg',
                'stock' => 55,
                'isbn' => '9780399144462',
                'rating' => 4.9,
                'category' => 'Business'
            ],
            [
                'title' => 'The Psychology of Money',
                'author' => 'Morgan Housel',
                'description' => 'Timeless lessons on wealth, greed, and happiness. Doing well with money isn\'t necessarily about what you know. It\'s about how you behave.',
                'price' => 32.00,
                'image' => 'psychology-money.jpg',
                'stock' => 42,
                'isbn' => '9780857197689',
                'rating' => 4.9,
                'category' => 'Finance'
            ],

            // More James Clear books
            [
                'title' => 'The 3-2-1 Newsletter',
                'author' => 'James Clear',
                'description' => 'A collection of the most popular insights from James Clear\'s 3-2-1 newsletter.',
                'price' => 28.00,
                'image' => 'james-clear-newsletter.jpg',
                'stock' => 25,
                'isbn' => '9780735212299',
                'rating' => 4.7,
                'category' => 'Self-Help'
            ],

            // Napoleon Hill books
            [
                'title' => 'Think and Grow Rich',
                'author' => 'Napoleon Hill',
                'description' => 'The landmark bestseller now revised and updated for the 21st century. Think and Grow Rich has been called the "Granddaddy of All Motivational Literature."',
                'price' => 29.00,
                'image' => 'think-grow-rich.jpg',
                'stock' => 60,
                'isbn' => '9781585424337',
                'rating' => 4.8,
                'category' => 'Success'
            ],
            [
                'title' => 'The Law of Success',
                'author' => 'Napoleon Hill',
                'description' => 'The Complete and Original Edition. Napoleon Hill\'s complete and original formula to achievement presented in fifteen remarkable principles.',
                'price' => 35.00,
                'image' => 'law-of-success.jpg',
                'stock' => 38,
                'isbn' => '9781585424542',
                'rating' => 4.7,
                'category' => 'Success'
            ],
            [
                'title' => 'Outwitting the Devil',
                'author' => 'Napoleon Hill',
                'description' => 'The Secret to Freedom and Success. Napoleon Hill\'s "lost" classic reveals how to break through limitations.',
                'price' => 31.00,
                'image' => 'outwitting-devil.jpg',
                'stock' => 33,
                'isbn' => '9781454900672',
                'rating' => 4.6,
                'category' => 'Philosophy'
            ],

            // Robert Kiyosaki books
            [
                'title' => 'Rich Dad Poor Dad',
                'author' => 'Robert Kiyosaki',
                'description' => 'What the Rich Teach Their Kids About Money That the Poor and Middle Class Do Not! Rich Dad Poor Dad is Robert\'s story of growing up with two dads.',
                'price' => 30.00,
                'image' => 'rich-dad-poor-dad.jpg',
                'stock' => 70,
                'isbn' => '9781612680194',
                'rating' => 4.8,
                'category' => 'Finance'
            ],
            [
                'title' => 'Cashflow Quadrant',
                'author' => 'Robert Kiyosaki',
                'description' => 'Rich Dad\'s Guide to Financial Freedom. Learn the four ways to generate income and how to navigate the changing economy.',
                'price' => 32.00,
                'image' => 'cashflow-quadrant.jpg',
                'stock' => 45,
                'isbn' => '9781612680057',
                'rating' => 4.7,
                'category' => 'Finance'
            ],
            [
                'title' => 'Retire Young Retire Rich',
                'author' => 'Robert Kiyosaki',
                'description' => 'How to Get Rich Quickly and Stay Rich Forever! A powerful story of how one couple achieves financial independence.',
                'price' => 33.00,
                'image' => 'retire-young.jpg',
                'stock' => 28,
                'isbn' => '9780446617437',
                'rating' => 4.5,
                'category' => 'Finance'
            ],

            // Brian Tracy books
            [
                'title' => 'Eat That Frog!',
                'author' => 'Brian Tracy',
                'description' => '21 Great Ways to Stop Procrastinating and Get More Done in Less Time. The idea is that you should do your most difficult task first thing in the morning.',
                'price' => 27.00,
                'image' => 'eat-that-frog.jpg',
                'stock' => 52,
                'isbn' => '9781576754221',
                'rating' => 4.7,
                'category' => 'Productivity'
            ],
            [
                'title' => 'Goals!',
                'author' => 'Brian Tracy',
                'description' => 'How to Get Everything You Want Faster Than You Ever Thought Possible. A proven system for setting and achieving goals.',
                'price' => 29.00,
                'image' => 'goals.jpg',
                'stock' => 40,
                'isbn' => '9781576753077',
                'rating' => 4.6,
                'category' => 'Self-Help'
            ],
            [
                'title' => 'The Psychology of Selling',
                'author' => 'Brian Tracy',
                'description' => 'Increase Your Sales Faster and Easier Than You Ever Thought Possible. Learn the secrets of increasing your sales.',
                'price' => 31.00,
                'image' => 'psychology-selling.jpg',
                'stock' => 35,
                'isbn' => '9780785288312',
                'rating' => 4.8,
                'category' => 'Sales'
            ],

            // Additional popular books
            [
                'title' => 'The 7 Habits of Highly Effective People',
                'author' => 'Stephen Covey',
                'description' => 'Powerful Lessons in Personal Change. One of the most inspiring and impactful books ever written.',
                'price' => 34.00,
                'image' => '7-habits.jpg',
                'stock' => 65,
                'isbn' => '9781982137274',
                'rating' => 4.9,
                'category' => 'Self-Help'
            ],
            [
                'title' => 'The Subtle Art of Not Giving a F*ck',
                'author' => 'Mark Manson',
                'description' => 'A Counterintuitive Approach to Living a Good Life. A book about finding what\'s important to you and letting go of everything else.',
                'price' => 28.00,
                'image' => 'subtle-art.jpg',
                'stock' => 58,
                'isbn' => '9780062457714',
                'rating' => 4.6,
                'category' => 'Self-Help'
            ],
            [
                'title' => '12 Rules for Life',
                'author' => 'Jordan Peterson',
                'description' => 'An Antidote to Chaos. A famous thinker suggests that philosophy and psychology can be deployed to address the most pressing issues of our time.',
                'price' => 33.00,
                'image' => '12-rules.jpg',
                'stock' => 47,
                'isbn' => '9780345816023',
                'rating' => 4.7,
                'category' => 'Philosophy'
            ],
            [
                'title' => 'Can\'t Hurt Me',
                'author' => 'David Goggins',
                'description' => 'Master Your Mind and Defy the Odds. David Goggins shares his astonishing life story and reveals that most of us tap into only 40% of our capabilities.',
                'price' => 30.00,
                'image' => 'cant-hurt-me.jpg',
                'stock' => 43,
                'isbn' => '9781544512273',
                'rating' => 4.8,
                'category' => 'Biography'
            ],
            [
                'title' => 'The Power of Now',
                'author' => 'Eckhart Tolle',
                'description' => 'A Guide to Spiritual Enlightenment. To make the journey into the Now we will need to leave our analytical mind and its false created self behind.',
                'price' => 31.00,
                'image' => 'power-of-now.jpg',
                'stock' => 41,
                'isbn' => '9781577314806',
                'rating' => 4.7,
                'category' => 'Spirituality'
            ],
            [
                'title' => 'Sapiens',
                'author' => 'Yuval Noah Harari',
                'description' => 'A Brief History of Humankind. How did our species succeed in the battle for dominance? Why did our foraging ancestors come together to create cities and kingdoms?',
                'price' => 35.00,
                'image' => 'sapiens.jpg',
                'stock' => 55,
                'isbn' => '9780062316110',
                'rating' => 4.8,
                'category' => 'History'
            ],
            [
                'title' => 'The Four Agreements',
                'author' => 'Don Miguel Ruiz',
                'description' => 'A Practical Guide to Personal Freedom. Based on ancient Toltec wisdom, The Four Agreements offer a powerful code of conduct.',
                'price' => 26.00,
                'image' => 'four-agreements.jpg',
                'stock' => 48,
                'isbn' => '9781878424310',
                'rating' => 4.7,
                'category' => 'Spirituality'
            ],
            [
                'title' => 'The Richest Man in Babylon',
                'author' => 'George S. Clason',
                'description' => 'The Success Secrets of the Ancients. Beloved by millions, this timeless classic holds the key to all you desire.',
                'price' => 25.00,
                'image' => 'richest-man-babylon.jpg',
                'stock' => 50,
                'isbn' => '9780451205360',
                'rating' => 4.8,
                'category' => 'Finance'
            ],
            [
                'title' => 'Deep Work',
                'author' => 'Cal Newport',
                'description' => 'Rules for Focused Success in a Distracted World. Deep work is the ability to focus without distraction on a cognitively demanding task.',
                'price' => 29.00,
                'image' => 'deep-work.jpg',
                'stock' => 44,
                'isbn' => '9781455586691',
                'rating' => 4.6,
                'category' => 'Productivity'
            ],
            [
                'title' => 'Start with Why',
                'author' => 'Simon Sinek',
                'description' => 'How Great Leaders Inspire Everyone to Take Action. People don\'t buy what you do; they buy why you do it.',
                'price' => 30.00,
                'image' => 'start-with-why.jpg',
                'stock' => 39,
                'isbn' => '9781591846444',
                'rating' => 4.7,
                'category' => 'Leadership'
            ],
            [
                'title' => 'The Lean Startup',
                'author' => 'Eric Ries',
                'description' => 'How Today\'s Entrepreneurs Use Continuous Innovation to Create Radically Successful Businesses.',
                'price' => 32.00,
                'image' => 'lean-startup.jpg',
                'stock' => 36,
                'isbn' => '9780307887894',
                'rating' => 4.6,
                'category' => 'Business'
            ],
            [
                'title' => 'Mindset',
                'author' => 'Carol S. Dweck',
                'description' => 'The New Psychology of Success. World-renowned Stanford University psychologist Carol Dweck discovered a simple but groundbreaking idea: the power of mindset.',
                'price' => 28.00,
                'image' => 'mindset.jpg',
                'stock' => 46,
                'isbn' => '9780345472328',
                'rating' => 4.7,
                'category' => 'Psychology'
            ],
            [
                'title' => 'Grit',
                'author' => 'Angela Duckworth',
                'description' => 'The Power of Passion and Perseverance. In this must-read book for anyone striving to succeed, pioneering psychologist Angela Duckworth shows parents, educators, students, and business people.',
                'price' => 29.00,
                'image' => 'grit.jpg',
                'stock' => 41,
                'isbn' => '9781501111105',
                'rating' => 4.6,
                'category' => 'Psychology'
            ]
        ];

        DB::table('books')->insert($books);
    }
}
