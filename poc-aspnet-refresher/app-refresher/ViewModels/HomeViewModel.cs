using System.ComponentModel.DataAnnotations;

namespace app_refresher.ViewModels;

public class HomeViewModel
{
    public ContactUsInputModel ContactForm { get; set; } = new();
    public List<TestimonialViewModel> Testimonials { get; set; } = new();
}

public class ContactUsInputModel
{
    [Required]
    [StringLength(120)]
    public string Name { get; set; } = string.Empty;

    [Required]
    [StringLength(2000, MinimumLength = 10)]
    public string Message { get; set; } = string.Empty;
}

public class TestimonialViewModel
{
    public string PersonName { get; set; } = string.Empty;
    public string Role { get; set; } = string.Empty;
    public string Quote { get; set; } = string.Empty;
}
