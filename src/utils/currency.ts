/**
 * Currency conversion utilities for converting USD to Nigerian Naira
 */

// Current approximate exchange rate (you can update this as needed)
const USD_TO_NGN_RATE = 850;

export function formatNaira(amount: number): string {
  return new Intl.NumberFormat('en-NG', {
    style: 'currency',
    currency: 'NGN',
    minimumFractionDigits: 0,
    maximumFractionDigits: 0,
  }).format(amount);
}

export function convertUsdToNgn(usdAmount: number): number {
  return Math.round(usdAmount * USD_TO_NGN_RATE);
}

export function parseUsdAmount(usdString: string): number {
  // Remove $ and commas, parse the number
  return parseFloat(usdString.replace(/[$,]/g, ''));
}

export function convertUsdStringToNgn(usdString: string): string {
  // Handle special cases
  if (usdString.includes('/hour')) {
    const amount = parseUsdAmount(usdString.replace('/hour', ''));
    return `${formatNaira(convertUsdToNgn(amount))}/hour`;
  }
  
  if (usdString.includes('/month')) {
    const amount = parseUsdAmount(usdString.replace('/month', ''));
    return `${formatNaira(convertUsdToNgn(amount))}/month`;
  }
  
  if (usdString.includes('%')) {
    // For percentage + fixed fee like "2.5% + $0.30"
    const parts = usdString.split(' + ');
    if (parts.length === 2) {
      const percentage = parts[0];
      const fixedAmount = parseUsdAmount(parts[1]);
      return `${percentage} + ${formatNaira(convertUsdToNgn(fixedAmount))}`;
    }
  }
  
  // Regular amount
  const amount = parseUsdAmount(usdString);
  return formatNaira(convertUsdToNgn(amount));
}

// Conversion mapping for all the prices we found
export const PRICE_CONVERSIONS = {
  '$2,500': convertUsdStringToNgn('$2,500'),        // ₦2,125,000
  '$150/hour': convertUsdStringToNgn('$150/hour'),   // ₦127,500/hour
  '2.5% + $0.30': convertUsdStringToNgn('2.5% + $0.30'), // 2.5% + ₦255
  '$15,000': convertUsdStringToNgn('$15,000'),       // ₦12,750,000
  '$5,000': convertUsdStringToNgn('$5,000'),         // ₦4,250,000
  '$25,000': convertUsdStringToNgn('$25,000'),       // ₦21,250,000
  '$299/month': convertUsdStringToNgn('$299/month'), // ₦254,150/month
  '$3,000': convertUsdStringToNgn('$3,000'),         // ₦2,550,000
  '$199/month': convertUsdStringToNgn('$199/month'), // ₦169,150/month
  '$10,000': convertUsdStringToNgn('$10,000'),       // ₦8,500,000
  '$200/hour': convertUsdStringToNgn('$200/hour'),   // ₦170,000/hour
  '$1,500': convertUsdStringToNgn('$1,500'),         // ₦1,275,000
};
