using Microsoft.AspNetCore.Mvc;
using app_refresher.Models;
using app_refresher.Services;
using app_refresher.ViewModels;

namespace app_refresher.Controllers;

public class HomeController : Controller
{
    private readonly IContactSubmissionService _contactSubmissionService;

    public HomeController(IContactSubmissionService contactSubmissionService)
    {
        _contactSubmissionService = contactSubmissionService;
    }

    [HttpGet]
    public IActionResult Index()
    {
        return View(BuildHomeViewModel());
    }

    [HttpPost]
    [ValidateAntiForgeryToken]
    public async Task<IActionResult> SubmitContact(HomeViewModel model)
    {
        model.Testimonials = GetTestimonials();

        if (!ModelState.IsValid)
        {
            return View("Index", model);
        }

        var submission = new ContactSubmission
        {
            Name = model.ContactForm.Name,
            Message = model.ContactForm.Message,
            SubmittedAtUtc = DateTime.UtcNow
        };

        await _contactSubmissionService.AddSubmissionAsync(submission);

        TempData["ContactSuccess"] = "Thanks for reaching out. We received your message.";
        return RedirectToAction(nameof(Index));
    }

    [HttpGet]
    public IActionResult About()
    {
        return View();
    }

    private static HomeViewModel BuildHomeViewModel()
    {
        return new HomeViewModel
        {
            Testimonials = GetTestimonials()
        };
    }

    private static List<TestimonialViewModel> GetTestimonials()
    {
        return new List<TestimonialViewModel>
        {
            new()
            {
                PersonName = "Lauren Meyer",
                Role = "Product Manager",
                Quote = "I found a fully remote role in under a month with clear guidance and credible openings."
            },
            new()
            {
                PersonName = "Daniel Obasi",
                Role = "DevOps Engineer",
                Quote = "The platform helped me filter serious remote employers and focus my applications."
            },
            new()
            {
                PersonName = "Aiko Tanaka",
                Role = "UX Designer",
                Quote = "Professional resources and a great network made the transition to remote work smooth."
            }
        };
    }
}
