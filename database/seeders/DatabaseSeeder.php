<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\KnowledgeArticle;
use App\Models\Payment;
use App\Models\Post;
use App\Models\Product;
use App\Models\Project;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::query()->updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Nestline Admin',
                'password' => 'password',
                'role' => 'admin',
                'phone' => '(512) 555-0148',
            ]
        );

        User::query()->updateOrCreate(
            ['email' => 'manager@example.com'],
            [
                'name' => 'Maya Ortega',
                'password' => 'password',
                'role' => 'manager',
                'phone' => '(512) 555-0191',
            ]
        );

        $staff = User::query()->updateOrCreate(
            ['email' => 'staff@example.com'],
            [
                'name' => 'Jordan Hale',
                'password' => 'password',
                'role' => 'staff',
                'phone' => '(512) 555-0177',
            ]
        );

        foreach ([
            'company_name' => 'Nestline Closet Studio',
            'phone' => '(512) 555-0148',
            'email' => 'hello@nestlinecloset.com',
            'whatsapp' => '15125550148',
            'address' => '1840 Burnet Rd, Suite 210, Austin, TX 78756',
            'service_area' => 'Greater Austin & Central Texas',
        ] as $key => $value) {
            Setting::setValue($key, $value);
        }

        $products = [
            ['name' => 'Soft-Close Hinge 35mm', 'sku' => 'HL-SC35', 'category' => 'hardware', 'unit_cost' => 2.40, 'unit_price' => 6.50, 'stock_qty' => 4, 'reorder_level' => 20],
            ['name' => 'Walnut Melamine Panel 4x8', 'sku' => 'PN-WAL48', 'category' => 'panels', 'unit_cost' => 68, 'unit_price' => 145, 'stock_qty' => 22, 'reorder_level' => 8],
            ['name' => 'LED Closet Strip 48in', 'sku' => 'LT-LED48', 'category' => 'lighting', 'unit_cost' => 18, 'unit_price' => 42, 'stock_qty' => 35, 'reorder_level' => 10],
            ['name' => 'Velvet Jewelry Drawer Insert', 'sku' => 'AC-VELJD', 'category' => 'accessories', 'unit_cost' => 22, 'unit_price' => 58, 'stock_qty' => 14, 'reorder_level' => 6],
            ['name' => 'Double Hang Rod Kit', 'sku' => 'HW-DHRK', 'category' => 'hardware', 'unit_cost' => 12, 'unit_price' => 29, 'stock_qty' => 40, 'reorder_level' => 12],
            ['name' => 'Drawer Box 18in Soft-Close', 'sku' => 'DR-SC18', 'category' => 'drawers', 'unit_cost' => 34, 'unit_price' => 79, 'stock_qty' => 18, 'reorder_level' => 8],
        ];

        foreach ($products as $product) {
            Product::query()->updateOrCreate(['sku' => $product['sku']], $product + ['is_active' => true, 'description' => $product['name'].' for Nestline installs.']);
        }

        $customers = collect([
            ['name' => 'Elena Brooks', 'email' => 'elena@example.com', 'phone' => '(512) 555-2201', 'city' => 'Austin', 'state' => 'TX', 'zip' => '78731', 'address' => '4412 Mountain View Rd'],
            ['name' => 'Chris & Ava Nguyen', 'email' => 'nguyen.home@example.com', 'phone' => '(512) 555-2208', 'city' => 'Cedar Park', 'state' => 'TX', 'zip' => '78613', 'address' => '908 Brushy Creek Ln'],
            ['name' => 'Harper Realty Staging', 'email' => 'ops@harperrealty.example', 'phone' => '(512) 555-2290', 'company' => 'Harper Realty', 'city' => 'Round Rock', 'state' => 'TX', 'zip' => '78664', 'address' => '120 Enterprise Blvd'],
            ['name' => 'Marcus Delgado', 'email' => 'marcus.d@example.com', 'phone' => '(512) 555-2215', 'city' => 'Lakeway', 'state' => 'TX', 'zip' => '78734', 'address' => '77 Highland Shore Dr'],
        ])->map(fn ($c) => Customer::query()->updateOrCreate(['email' => $c['email']], $c));

        $projectDefs = [
            ['number' => 'NL-260301-101', 'title' => 'Primary walk-in remodel', 'closet_type' => 'walk-in', 'status' => 'production', 'estimated_value' => 12400],
            ['number' => 'NL-260301-102', 'title' => 'Kids reach-in refresh', 'closet_type' => 'kids', 'status' => 'design', 'estimated_value' => 2800],
            ['number' => 'NL-260301-103', 'title' => 'Pantry pull-out upgrade', 'closet_type' => 'pantry', 'status' => 'approved', 'estimated_value' => 4100],
            ['number' => 'NL-260301-104', 'title' => 'Garage gear wall', 'closet_type' => 'garage', 'status' => 'lead', 'estimated_value' => 5600],
            ['number' => 'NL-260301-105', 'title' => 'Guest suite reach-in', 'closet_type' => 'reach-in', 'status' => 'install', 'estimated_value' => 3200],
            ['number' => 'NL-260301-106', 'title' => 'Mudroom locker bank', 'closet_type' => 'mudroom', 'status' => 'completed', 'estimated_value' => 6900],
        ];

        $projects = collect();
        foreach ($projectDefs as $i => $def) {
            $projects->push(Project::query()->updateOrCreate(
                ['number' => $def['number']],
                $def + [
                    'customer_id' => $customers[$i % $customers->count()]->id,
                    'assigned_to' => $i % 2 === 0 ? $admin->id : $staff->id,
                    'start_date' => now()->subDays(20 - $i),
                    'due_date' => now()->addDays(10 + $i),
                    'scope' => 'Custom Nestline closet system with soft-close hardware and adjustable shelving.',
                ]
            ));
        }

        $invoice = Invoice::query()->updateOrCreate(
            ['number' => 'INV-260301-201'],
            [
                'customer_id' => $customers[0]->id,
                'project_id' => $projects[0]->id,
                'status' => 'partial',
                'issue_date' => now()->subDays(12),
                'due_date' => now()->addDays(18),
                'subtotal' => 11200,
                'tax' => 924,
                'total' => 12124,
                'amount_paid' => 6062,
                'notes' => '50% deposit received at design approval.',
            ]
        );

        Invoice::query()->updateOrCreate(
            ['number' => 'INV-260301-202'],
            [
                'customer_id' => $customers[5 % $customers->count()]->id,
                'project_id' => $projects[5]->id,
                'status' => 'paid',
                'issue_date' => now()->subMonths(1),
                'due_date' => now()->subDays(10),
                'subtotal' => 6400,
                'tax' => 528,
                'total' => 6928,
                'amount_paid' => 6928,
            ]
        );

        Payment::query()->updateOrCreate(
            ['reference' => 'DEP-NL-101'],
            [
                'invoice_id' => $invoice->id,
                'amount' => 6062,
                'method' => 'card',
                'paid_at' => now()->subDays(11),
                'notes' => 'Deposit',
            ]
        );

        Payment::query()->updateOrCreate(
            ['reference' => 'FIN-NL-106'],
            [
                'invoice_id' => Invoice::query()->where('number', 'INV-260301-202')->first()->id,
                'amount' => 6928,
                'method' => 'ach',
                'paid_at' => now()->subDays(20),
            ]
        );

        Appointment::query()->updateOrCreate(
            ['title' => 'Measure — Brooks walk-in'],
            [
                'customer_id' => $customers[0]->id,
                'project_id' => $projects[0]->id,
                'user_id' => $staff->id,
                'type' => 'measure',
                'status' => 'completed',
                'starts_at' => now()->subDays(14)->setTime(10, 0),
                'ends_at' => now()->subDays(14)->setTime(11, 0),
                'location' => $customers[0]->address.', '.$customers[0]->city,
            ]
        );

        Appointment::query()->updateOrCreate(
            ['title' => 'Install — Guest reach-in'],
            [
                'customer_id' => $customers[1]->id,
                'project_id' => $projects[4]->id,
                'user_id' => $staff->id,
                'type' => 'install',
                'status' => 'confirmed',
                'starts_at' => now()->addDays(2)->setTime(8, 30),
                'ends_at' => now()->addDays(2)->setTime(16, 0),
                'location' => $customers[1]->address.', '.$customers[1]->city,
            ]
        );

        Appointment::query()->updateOrCreate(
            ['title' => 'Design review — Pantry'],
            [
                'customer_id' => $customers[2]->id,
                'project_id' => $projects[2]->id,
                'user_id' => $admin->id,
                'type' => 'design',
                'status' => 'scheduled',
                'starts_at' => now()->addDays(5)->setTime(14, 0),
                'ends_at' => now()->addDays(5)->setTime(15, 0),
                'location' => 'Nestline studio showroom',
            ]
        );

        $posts = [
            [
                'title' => 'How to size hanging space for a primary walk-in',
                'slug' => 'size-hanging-space-primary-walk-in',
                'excerpt' => 'A practical ratio of long hang, double hang, and folded storage for Austin primary suites.',
                'cover_image' => 'https://images.unsplash.com/photo-1558997519-83ea9252edf8?auto=format&fit=crop&w=1400&q=80',
                'body' => "Most walk-ins fail because hanging inches are guessed, not measured against your wardrobe.\n\nStart by sorting garments into long hang (dresses, coats), double hang (shirts, folded pants), and folded stacks. Nestline designers typically allocate 30–40% of wall length to long hang for primary suites, then fill the rest with double hang and drawers.\n\nLeave a clear aisle of at least 36 inches when an island is present, and plan LED lighting above each hanging bay so dark corners do not hide inventory.",
            ],
            [
                'title' => 'Reach-in closets: reclaiming the top shelf dead zone',
                'slug' => 'reach-in-top-shelf-dead-zone',
                'excerpt' => 'Use adjustable standards and short shelves to make the upper third useful again.',
                'cover_image' => 'https://images.unsplash.com/photo-1595428774223-ef5262434d6f?auto=format&fit=crop&w=1400&q=80',
                'body' => "The top shelf in a bifold closet often becomes a graveyard for suitcases and forgotten boxes.\n\nNestline reach-in systems replace a single high shelf with staggered shelves and a second hanging rod where ceiling height allows. Seasonal bins stay labeled and within a step-stool reach, while everyday clothing stays at eye level.\n\nAsk for soft-close drawers under hanging rods—they add folded capacity without eating floor space.",
            ],
            [
                'title' => 'Pantry organizers that survive Texas grocery runs',
                'slug' => 'pantry-organizers-texas-grocery-runs',
                'excerpt' => 'Pull-outs, can risers, and door racks keep Costco hauls from burying weeknight staples.',
                'cover_image' => 'https://images.unsplash.com/photo-1556912173-46c336c7fd55?auto=format&fit=crop&w=1400&q=80',
                'body' => "Bulk shopping is great until the pasta boxes hide the olive oil.\n\nWe design pantry walls with full-extension pull-outs, weighted can risers, and door-mounted spice rails. Clear zones for snacks, baking, and breakfast reduce the nightly hunt.\n\nIf your pantry doubles as a drop zone, add a slim locker section for lunch bags and reusable bottles—still part of the Nestline closet language, just tuned for kitchens.",
            ],
        ];

        foreach ($posts as $post) {
            Post::query()->updateOrCreate(
                ['slug' => $post['slug']],
                $post + ['is_published' => true, 'published_at' => now()->subDays(rand(3, 40))]
            );
        }

        $articles = [
            [
                'title' => 'Doors rubbing after install',
                'slug' => 'doors-rubbing-after-install',
                'category' => 'common-issues',
                'sort_order' => 1,
                'body' => "1. Confirm the closet floor is level where the tower sits.\n2. Check hinge cup screws are fully seated in melamine.\n3. Adjust soft-close hinges with the depth and lateral screws before shimming panels.\n4. If humidity has swollen a panel edge, contact Nestline warranty support with photos.",
            ],
            [
                'title' => 'Missing soft-close hinges on install day',
                'slug' => 'missing-soft-close-hinges',
                'category' => 'common-issues',
                'sort_order' => 2,
                'body' => "Check SKU HL-SC35 stock in the ERP inventory screen. If below reorder level, create a rush PO and reschedule only the door hang portion—shelving can still proceed.",
            ],
            [
                'title' => 'From lead to measure appointment',
                'slug' => 'lead-to-measure-appointment',
                'category' => 'guides',
                'sort_order' => 1,
                'body' => "1. Capture the contact message in CRM.\n2. Create a Customer and a Project with status Lead.\n3. Schedule a Measure appointment with assigned designer.\n4. After the visit, move status to Measured and upload notes.",
            ],
            [
                'title' => 'Approving a design and collecting deposit',
                'slug' => 'approving-design-collecting-deposit',
                'category' => 'guides',
                'sort_order' => 2,
                'body' => "1. Set project status to Approved.\n2. Create an invoice for 50% of estimated value.\n3. Record the payment; status becomes Partial.\n4. Release materials to production only after deposit posts.",
            ],
            [
                'title' => 'Admin roles overview',
                'slug' => 'admin-roles-overview',
                'category' => 'admin-manual',
                'sort_order' => 1,
                'body' => "Admin — full ERP access, settings, users.\nManager — projects, invoices, inventory, appointments.\nStaff — day-to-day project and appointment updates.\nLogin at /admin with your Nestline credentials.",
            ],
            [
                'title' => 'Using AI tools in the admin panel',
                'slug' => 'using-ai-tools-admin',
                'category' => 'admin-manual',
                'sort_order' => 2,
                'body' => "AI Content Generator drafts blog and product copy.\nAutomation Suggestions proposes workflow ideas.\nTroubleshooting Assistant helps with inventory and scheduling conflicts.\nWithout API keys, tools return Nestline FAQ demo responses.",
            ],
            [
                'title' => 'Invoice balance does not match payments',
                'slug' => 'invoice-balance-mismatch',
                'category' => 'troubleshooting',
                'sort_order' => 1,
                'body' => "Sum all Payment records for the invoice and compare to amount_paid. Update amount_paid, then set status to Paid or Partial. Void duplicate payment rows instead of deleting history when possible.",
            ],
            [
                'title' => 'Appointment double-booking',
                'slug' => 'appointment-double-booking',
                'category' => 'troubleshooting',
                'sort_order' => 2,
                'body' => "Filter Appointments by staff user and starts_at date. Move the lower-priority visit, notify the customer, and add a note on both project records.",
            ],
        ];

        foreach ($articles as $article) {
            KnowledgeArticle::query()->updateOrCreate(
                ['slug' => $article['slug']],
                $article + ['is_published' => true]
            );
        }
    }
}
